<?php
namespace App\Http\Controllers;


use App\Invitation;
use App\Http\StoreInvitationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationsController extends Controller
{
    public function store(Request $request)
    {

        $user = Auth::user();
        if($user)
            $user_id=$user->id;
        else
            $user_id=0;

        $invitation = new Invitation($request->all());
        $invitation->generateInvitationToken($user_id);
        if($user_id)
            $invitation->referer_id=$user_id;
        $invitation->save();

        if(!$user){
            return redirect()->route('requestInvitation')
                ->with('success', 'Invitation to register successfully requested. Please wait for registration link. '.$invitation->getLink());
        }
        else{// user authenticated mostra gli inviti
            return redirect()->route('invitations');
        }
    }

    public function index(){
        $user = Auth::user();
        if(!$user->isAdmin())
            $invitations = Invitation::where('registered_at', null)->where('referer_id', $user->id)->orderBy('created_at', 'desc')->get();// vedo solo gli inviti che ho mandato
        else
            $invitations = Invitation::where('registered_at', null)->orderBy('created_at', 'desc')->get();// admin vede tutti gli inviti

        return view('invitations.index', compact('invitations'));
    }

    public function create(){
        return view('invitations.create');
    }

    public function destroy($id){
        $user = Auth::user();
        if($user->isAdmin())
            $invitation= Invitation::where('id',$id);
        else
            $invitation=Invitation::where('id',$id)->where('referer_id',$user->id);

        $invitation=$invitation->first();

        if($invitation)
            $invitation->delete();

        return redirect()->route('invitations');
    }
}
