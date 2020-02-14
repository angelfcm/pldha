<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Http\Requests\MemberRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    const TMP_IMAGES_FOLDER = 'public/tmp/member-images';
    const STATIC_IMAGES_FOLDER = 'public/member-images';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $folio = $request->query('folio', '');
        $hide_verified = $request->query('hide_verified', false);
        $hide_no_verified = $request->query('hide_no_verified', false);

        $members = new Member;
        if (!empty($folio)) {
            $members = $members->where('folio', $folio);
        }
        else {
            if ($hide_verified) {
                $members = $members->where('verified', false);
            }
            if ($hide_no_verified) {
                $members = $members->where('verified', true);
            }
        }

        $members = $members->paginate(12);  

        return view('members.list', ['members' => $members, 'folio' => $folio, 'hide_verified' => $hide_verified, 'hide_no_verified' => $hide_no_verified]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $member = new Member([
            'folio' => old('folio', ''),
            'id_number' => old('id_number', ''),
            'fullname' => old('fullname', ''),
            'phone_number' => old('phone_number', ''),
            'email' => old('email', ''),
            'country_abbr' => old('country_abbr', ''),
            'state_code' => old('state_code', null),
            'town_code' => old('town_code', null),   
            'credential_photo' => old('credential_photo', ''),
            'official_id_photo_back' => old('official_id_photo_back', ''),
            'official_id_photo_front' => old('official_id_photo_front', ''),
            'other_official_id_photo' => old('other_official_id_photo', ''),
            'occupation_code' => old('occupation_code', null),
            'occupation' => old('occupation', ''),
            'member_comment' => old('member_comment', ''),
            'verified' => old('verified', false)
        ]);

        return view('members.form', compact('member'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request)
    {
        $member = new Member($request->all());

        $this->saveImage($member, 'credential_photo');
        $this->saveImage($member, 'official_id_photo_back');
        $this->saveImage($member, 'official_id_photo_front');
        $this->saveImage($member, 'other_official_id_photo');

        $member->save();
        $this->setFolio($member);

        return redirect()->route('members.index')->with('success','¡Miembro creado satisfactoriamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        $member->folio = old('folio', $member->folio);
        $member->id_number = old('id_number', $member->id_number);
        $member->fullname = old('fullname', $member->fullname);
        $member->phone_number = old('phone_number', $member->phone_number);
        $member->email = old('email', $member->email);
        $member->country_abbr = old('country_abbr', $member->country_abbr);
        $member->state_code = old('state_code', $member->state_code);
        $member->town_code = old('town_code', $member->town_code);
        $member->credential_photo = old('credential_photo', $member->credential_photo);
        $member->official_id_photo_back = old('official_id_photo_back', $member->official_id_photo_back);
        $member->official_id_photo_front = old('official_id_photo_front', $member->official_id_photo_front);
        $member->other_official_id_photo = old('other_official_id_photo', $member->other_official_id_photo);
        $member->occupation_code = old('occupation_code', $member->occupation_code);
        $member->occupation = old('occupation', $member->occupation);
        $member->member_comment = old('member_comment', $member->member_comment);
        $member->verified = old('verified', $member->verified);

        return view('members.form', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(MemberRequest $request, Member $member)
    {
        $member->fill($request->all());

        $this->saveImage($member, 'credential_photo');
        $this->saveImage($member, 'official_id_photo_back');
        $this->saveImage($member, 'official_id_photo_front');
        $this->saveImage($member, 'other_official_id_photo');

        $member->save();

        return redirect()->route('members.index')->with('success','¡Miembro actualizado satisfactoriamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();

        $imageURLS = ['credential_photo', 'official_id_photo_back', 'official_id_photo_front', 'other_official_id_photo'];
        
        foreach ($imageURLS as $url) {
            $path = $this->publicURLToLocalPath($url);
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
        }

        return back()->withInput()->with('success','¡Miembro eliminado satisfactoriamente!');
    }

    public function updateVerification(Request $request, $id)
    {
        $member = Member::find($id);
        if (!$member) {
            abort(404);
        }
        if (!$request->has('verified')) {
            abort(501);
        }
        $member->verified = $request->input('verified') ? 1 : 0;
        $member->save();
        return response()->json(['status' => 'OK']);
    }

    public function printPdfCredential($id) 
    {
        $member = Member::find($id);
        if (!$member) {
            abort(404);
        }

        if ($member->verified) {
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('members.credential', array('member' => $member))
                ->setPaper('letter', 'portrait');
            return $pdf->stream();
        }
        else {
            return view('members.invalid');
        }
    }

    /** 
     * Establece el folio dado el formato correspondiente tomando los valores de algunos de los atributos. 
     */ 
    public function setFolio(Member $member) 
    {
        if (!$member->exists)
            return false;

        // Coloca id que se le asignará y se rellena con ceros.
        $zeroFilledNextId = str_pad($member->id, 4, "0", STR_PAD_LEFT);
        $state_abbr = 'AAA';
        foreach(config('app.state_codes') as $abbr => $code) {
            if ($code == $member->state_code) {
                $state_abbr = $abbr;
                break;
            }
        }
        $folio = $member->occupation_code . $member->country_abbr . $state_abbr . $member->town_code . $zeroFilledNextId;
        
        $member->folio = $folio;
        $member->save();

        return true;
    }

    public function uploadImage(Request $request)
    {
        $path = Storage::putFile(static::TMP_IMAGES_FOLDER, $request->file('image'));
        $fullPath = Storage::path($path);
        $url = $this->localPathToPublicURL($path);
        $image = \Image::make($fullPath);

        if ($image->width() > $image->height()) {
            $image->widen(640)->save($fullPath);
        } else {
            $image->heighten(640)->save($fullPath);
        }
        
        return response()->json(compact('url'));
    }

    private function saveImage($res, $imageName) 
    {
        $imagePath = $this->publicURLToLocalPath($res[$imageName]);
        $oldImagePath = null;
        $freshsub = $res->fresh();
        if ($freshsub != null) {
            $oldImagePath = $this->publicURLToLocalPath($freshsub[$imageName]);
        }
        if ($oldImagePath != $imagePath && Storage::exists($oldImagePath)) {
            Storage::delete($oldImagePath);
        }

        $publicURL = null;

        if ($imagePath != null) {
            $publicURL =  $res[$imageName];
        }

        if (Storage::exists($imagePath) && dirname($imagePath) == static::TMP_IMAGES_FOLDER) {
            $newPath = static::STATIC_IMAGES_FOLDER . '/' . basename($imagePath);
            Storage::move($imagePath, $newPath);
            $publicURL = $this->localPathToPublicURL($newPath);
        } 

        $res[$imageName] = $publicURL;
    }

    private function publicURLToLocalPath($url) {
        return preg_replace(['/https?:\/\/.+?storage\//i'], ['public/'], $url);
    }

    private function localPathToPublicURL($path) {
        return asset(Storage::url($path));
    }
}
