<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileManagerRequest;
use App\Models\File;
use App\Services\FileManagerService;
use Illuminate\Http\Request;

class FileManagerController extends Controller
{

    public function __construct(
        private readonly FileManagerService $fileManagerService,
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = File::paginate(10);

        return response()->json($files);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FileManagerRequest $request)
    {
        $this->validateRequest($request);

        if ($this->hasErrors()) {
            return $this->errorResponse();
        }

        $this->fileManagerService->add(
            $request->file('image'),
            $request->get('email'),
            $request->get('name')
        );

        return response()->json([
            'url' => $this->fileManagerService->getFileUrl(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->fileManagerService->remove($id);

        return response()->json([]);
    }
}
