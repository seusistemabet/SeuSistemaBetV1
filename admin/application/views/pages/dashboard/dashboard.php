<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Estatísticas</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
          </div>
        </div>
      </div>
        <div class="row" id="dashboard-admin">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="media p-3">
                                    <div class="media-body">
                                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Lucro 24H</span>
                                        <h2 class="mb-0">R$ <?php echo $statistics['LUCRO_24H']; ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="media p-3">
                                    <div class="media-body">
                                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Lucro 7D</span>
                                        <h2 class="mb-0">R$ <?php echo $statistics['LUCRO_7D']; ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="media p-3">
                                    <div class="media-body">
                                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Lucro 1M</span>
                                        <h2 class="mb-0">R$ <?php echo $statistics['LUCRO_1M']; ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="media p-3">
                                    <div class="media-body">
                                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Lucro Total</span>
                                        <h2 class="mb-0"><?php if(!empty($statistics['LUCRO_TOTAL'])): ?>R$ <?php echo $statistics['LUCRO_TOTAL']; ?><?php else: ?>R$ - <?php endif; ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2" id="dashboard-admin">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="media p-3">
                                    <div class="media-body">
                                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Depósitos nas últimas 24H</span>
                                        <h2 class="mb-0">R$ <?php echo $statistics['DEPOSITOS_24H']; ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="media p-3">
                                    <div class="media-body">
                                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Depósitos nos últimas 7D</span>
                                        <h2 class="mb-0">R$ <?php echo $statistics['DEPOSITOS_7D']; ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="media p-3">
                                    <div class="media-body">
                                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Depósitos no 1M</span>
                                        <h2 class="mb-0">R$ <?php echo $statistics['DEPOSITOS_1M']; ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="media p-3">
                                    <div class="media-body">
                                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Deposito total</span>
                                        <h2 class="mb-0">R$ <?php echo $statistics['DEPOSITOS_TOTAL']; ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2" id="dashboard-admin">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="media p-3">
                                    <div class="media-body">
                                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">PIX's Gerados 24H</span>
                                        <h2 class="mb-0"><?php echo $statistics['PIXS_GERADOS_24H']; ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="media p-3">
                                    <div class="media-body">
                                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">PIX's Pagos 24H</span>
                                        <h2 class="mb-0"><?php echo $statistics['PIXS_PAGOS_24H']; ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="media p-3">
                                    <div class="media-body">
                                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">PIX's Gerados</span>
                                        <h2 class="mb-0"><?php echo $statistics['PIXS_GERADOS_TOTAIS']; ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="media p-3">
                                    <div class="media-body">
                                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">PIX's Pagos</span>
                                        <h2 class="mb-0"><?php echo $statistics['PIXS_PAGOS_TOTAIS']; ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2" id="dashboard-admin">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="media p-3">
                                    <div class="media-body">
                                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Cadastros 24H</span>
                                        <h2 class="mb-0"><?php echo $statistics['CADASTRO_24H']; ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="media p-3">
                                    <div class="media-body">
                                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Cadastros 7D</span>
                                        <h2 class="mb-0"><?php echo $statistics['CADASTRO_7D']; ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="media p-3">
                                    <div class="media-body">
                                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Cadastros 30D</span>
                                        <h2 class="mb-0"><?php echo $statistics['CADASTRO_30D']; ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="media p-3">
                                    <div class="media-body">
                                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Cadastros Totais</span>
                                        <h2 class="mb-0"><?php echo $statistics['CADASTRO_TOTAIS']; ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-2" id="dashboard-admin">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="media p-3">
                                    <div class="media-body">
                                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">GGR</span>
                                        <h2 class="mb-0">8%</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="media p-3">
                                    <div class="media-body">
                                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Saldo API</span>
                                        <h2 class="mb-0">R$ <?php echo $saldoFiver; ?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                
                            </div>

                            <div class="col-lg-3">
                                <div class="media p-3">
                                    <div class="media-body">
                                        <span class="text-muted text-uppercase font-size-12 font-weight-bold">Resync da API </span>
                                        <a href="<?php echo site_url('GamesAPI/sync'); ?>" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-sync"><path d="M9 20H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3.9a2 2 0 0 1 1.69.9l.81 1.2a2 2 0 0 0 1.67.9H20a2 2 0 0 1 2 2v1"/><path d="M12 10v4h4"/><path d="m12 14 1.5-1.5c.9-.9 2.2-1.5 3.5-1.5s2.6.6 3.5 1.5c.4.4.8 1 1 1.5"/><path d="M22 22v-4h-4"/><path d="m22 18-1.5 1.5c-.9.9-2.1 1.5-3.5 1.5s-2.6-.6-3.5-1.5c-.4-.4-.8-1-1-1.5"/></svg> Sincronizar</a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
