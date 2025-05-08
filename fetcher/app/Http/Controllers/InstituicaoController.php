<?php

namespace App\Http\Controllers;

use App\Http\Resources\InstituicaoResource;
use App\Services\InstituicaoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class InstituicaoController extends Controller
{
    /**
     * @var InstituicaoService
     */
    protected InstituicaoService $instituicaoService;
    
    /**
     * Constructor
     * 
     * @param InstituicaoService $instituicaoService
     */
    public function __construct(InstituicaoService $instituicaoService)
    {
        $this->instituicaoService = $instituicaoService;
    }
    
    /**
     * Retorna a lista de instituições formatada
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $instituicoes = $this->instituicaoService->getInstituicoes();
        return InstituicaoResource::collection($instituicoes);
    }
    
    /**
     * Retorna uma instituição específica pelo ID (chave)
     *
     * @param string $id
     * @return InstituicaoResource|JsonResponse
     */
    public function show(string $id): InstituicaoResource|JsonResponse
    {
        $instituicao = $this->instituicaoService->getInstituicao($id);
        
        if (!$instituicao) {
            return response()->json(['message' => 'Instituição não encontrada'], 404);
        }
        
        return new InstituicaoResource($instituicao);
    }
} 