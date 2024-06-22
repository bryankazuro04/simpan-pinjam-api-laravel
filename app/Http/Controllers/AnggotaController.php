<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnggotaCreateRequest;
use App\Http\Resources\AnggotaResource;
use Illuminate\Http\JsonResponse;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    private function getAnggota(User $user, int $idAnggota): Anggota
    {
        $anggota = Anggota::where('user_id', $user->id)
            ->where('id', $idAnggota)
            ->first();
        if (!$anggota) {
            throw new HttpResponseException(
                response()
                    ->json([
                        'errors' => [
                            'message' => ['not found'],
                        ],
                    ])
                    ->setStatusCode(404),
            );
        }

        return $anggota;
    }

    public function create(AnggotaCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = Auth::user();

        $anggota = new Anggota($data);
        $anggota->user_id = $user->id;
        $anggota->save();
        return (new AnggotaResource($anggota))->response()->setStatusCode(201);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $user = Auth::user();

        $anggotas = Anggota::where('user_id', $user->id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Pengambilan daftar anggota sukses',
            'data' => [
                'anggotas' => AnggotaResource::collection($anggotas)
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $user = Auth::user();
        $anggota = $this->getAnggota($user, $id);

        $anggota->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Anggota berhasil diperbarui',
            'data' => new AnggotaResource($anggota)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $user = Auth::user();
        $anggota = $this->getAnggota($user, $id);

        $anggota->delete();

        return response()->json([
            'success' => true,
            'message' => 'Anggota berhasil dihapus'
        ]);
    }
}
