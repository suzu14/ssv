<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Cloudinary;
use Strage;

class DocumentController extends Controller
{
    public function index(Document $document, Group $group, User $user)
    {
        return view('documents/index')->with(['documents' => $document->get(), 'groups' => $group, 'user' => $user]);
    }
    
    public function show(Document $document)
    {
        return view('documents/show')->with(['document' => $document]);
    }
    
    public function upload(Request $request, Document $document, User $user)
    {
        //s3アップロード開始
        //$document_file = $request->file('document_file');
        //dd($document_file);
        // バケットの'document'フォルダへアップロード
        //$path = Storage::disk('s3')->putFile('document', $document_file, 'public');
        
        //cloudinaryへ画像を送信し、画像のURLを$document->pathに代入している
        $document->path = Cloudinary::upload($request->file('document_file')->getRealPath())->getSecurePath();
        $document->path = Str::before($document->path, '.pdf');
        $document->user_id = Auth::id();
        $document->save();
        //dd($document);
        
        return redirect('/documents/' . $document->id);
    }
}
