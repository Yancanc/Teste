<?php

namespace App\Http\Controllers;

use App\Http\Requests\SimulacaoCreditoRequest;
use App\Http\Resources\SimulacaoCreditoResource;
use App\Services\SimulacaoCreditoService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SimulacaoCreditoController extends Controller
{
    /**
     * @var SimulacaoCreditoService
     */
    protected SimulacaoCreditoService $simulacaoCreditoService;
    
    /**
     * Constructor
     * 
     * @param SimulacaoCreditoService $simulacaoCreditoService
     */
    public function __construct(SimulacaoCreditoService $simulacaoCreditoService)
    {
        $this->simulacaoCreditoService = $simulacaoCreditoService;
    }
    
    /**
     * Realiza a simulação de crédito
     *
     * @param SimulacaoCreditoRequest $request
     * @return AnonymousResourceCollection
     */
    public function simular(SimulacaoCreditoRequest $request): AnonymousResourceCollection
    {
        // Obter os dados validados da requisição
        $valorEmprestimo = (float) $request->input('valor_emprestimo');
        $instituicoes = $request->input('instituicoes');
        $convenios = $request->input('convenios');
        $parcela = $request->input('parcela');
        
        // Realizar a simulação
        $resultado = $this->simulacaoCreditoService->simular(
            $valorEmprestimo,
            $instituicoes,
            $convenios,
            $parcela
        );
        
        // Retornar o resultado formatado
        return SimulacaoCreditoResource::collection($resultado);
    }
} 