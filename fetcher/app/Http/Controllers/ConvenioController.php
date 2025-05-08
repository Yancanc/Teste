<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConvenioResource;
use App\Services\ConvenioService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ConvenioController extends Controller
{
    /**
     * @var ConvenioService
     */
    protected ConvenioService $convenioService;
    
    /**
     * Constructor
     * 
     * @param ConvenioService $convenioService
     */
    public function __construct(ConvenioService $convenioService)
    {
        $this->convenioService = $convenioService;
    }
    
    /**
     * Retorna a lista de convênios formatada
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $convenios = $this->convenioService->getConvenios();
        return ConvenioResource::collection($convenios);
    }
    
    /**
     * Retorna um convênio específico pelo ID (chave)
     *
     * @param string $id
     * @return ConvenioResource|JsonResponse
     */
    public function show(string $id): ConvenioResource|JsonResponse
    {
        $convenio = $this->convenioService->getConvenio($id);
        
        if (!$convenio) {
            return response()->json(['message' => 'Convênio não encontrado'], 404);
        }
        
        return new ConvenioResource($convenio);
    }
} 