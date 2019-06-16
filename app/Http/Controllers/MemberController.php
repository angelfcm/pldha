<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use Illuminate\Support\Collection;

class MemberController extends Controller
{
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
            dd($folio);
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
        return view('members.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credential_photo = null;
        if ($request->has('credential_photo')) {
            $credential_photo = asset('storage/'.basename($request->file('credential_photo')->store('public')));
        }
        $official_id_photo_back = null;
        if ($request->has('official_id_photo_back')) {
            $official_id_photo_back = asset('storage/'.basename($request->file('official_id_photo_back')->store('public')));
        } 
        $official_id_photo_front = null;
        if ($request->has('official_id_photo_front')) {
            $official_id_photo_front = asset('storage/'.basename($request->file('official_id_photo_front')->store('public')));
        }
        $other_official_id_photo = null;
        if ($request->has('other_official_id_photo')) {
            $other_official_id_photo = asset('storage/'.basename($request->file('other_official_id_photo')->store('public')));
        }
        Member::create([
            'id_number' => $request->input('id_number', null),
            'fullname' => $request->input('fullname', null),
            'phone_number' => $request->input('phone_number', null),
            'email' => $request->input('email', null),
            'country_abbr' => $request->input('country_abbr', null),
            'state_code' => $request->input('state_code', null),
            'town_code' => $request->input('town_code', null),
            'credential_photo' => $credential_photo,
            'official_id_photo_back' => $official_id_photo_back,
            'official_id_photo_front' => $official_id_photo_front,
            'other_official_id_photo' => $other_official_id_photo,
            'occupation_code' => $request->input('occupation_code', null),
            'occupation' => $request->input('occupation', null),
            'member_comment' => $request->input('member_comment', null),
            'verified' => false,
        ]);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

        return back()->withInput();
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
}
