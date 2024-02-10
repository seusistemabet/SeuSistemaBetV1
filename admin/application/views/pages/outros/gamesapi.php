<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
        <h1 class="h2">Configuração API de Jogos</h1>
      </div> 
      <div class="container mt-3">
      <?php if ($this->session->flashdata('msg')): ?> 

      <div class="alert alert-<?= $this->session->flashdata('tipo'); ?> text-center"" role="alert">
        <?= $this->session->flashdata('msg'); ?>
      </div>

      <?php endif; ?>

      <div class="mt-3 mb-3">
            <a href="<?php echo site_url('GamesAPI/sync'); ?>" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-sync"><path d="M9 20H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3.9a2 2 0 0 1 1.69.9l.81 1.2a2 2 0 0 0 1.67.9H20a2 2 0 0 1 2 2v1"/><path d="M12 10v4h4"/><path d="m12 14 1.5-1.5c.9-.9 2.2-1.5 3.5-1.5s2.6.6 3.5 1.5c.4.4.8 1 1 1.5"/><path d="M22 22v-4h-4"/><path d="m22 18-1.5 1.5c-.9.9-2.1 1.5-3.5 1.5s-2.6-.6-3.5-1.5c-.4-.4-.8-1-1-1.5"/></svg> Sincronizar</a>
      </div>
     
      <form method="post" action="<?php echo site_url('GamesAPI/save'); ?>">
            <div class="mb-3">
                <label for="url" class="form-label">URL</label>
                <input type="text" class="form-control" id="url" name="url" value="<?php echo $config[0]->url ?>">
            </div>
            <div class="mb-3">
                    <label for="agent_code" class="form-label">Agent Code</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control"  id="agent_code" name="agent_code" value="<?php echo $config[0]->agent_code ?>">
                        <button class="btn btn-outline-secondary show-password-btn" type="button" id="button-addon2">Mostrar</button>
                    </div>
            </div>
            <div class="mb-3">
                    <label for="agent_token" class="form-label">Token</label>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control"  id="agent_token" name="agent_token" value="<?php echo $config[0]->agent_token ?>">
                        <button class="btn btn-outline-secondary show-password-btn" type="button" id="button-addon2">Mostrar</button>
                    </div>
            </div>
            <div class="mb-3">
                <label for="client_id" class="form-label">RTP% (Chances de Ganhar)</label>
                <input type="number" class="form-control" id="ativo" name="ativo" value="<?php echo $config[0]->ativo ?>">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
      </form>

      
    </div>

</main>

<script>
        $(document).ready(function() {
            $('.show-password-btn').on('click', function() {
                var passwordField = $(this).prev('input[type="password"]');
                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                } else {
                    passwordField.attr('type', 'password');
                }
            });
        });
    </script>