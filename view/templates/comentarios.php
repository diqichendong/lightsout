<!-- Modal Comentarios -->
<div class="modal fade" id="modal-comentarios" data-bs-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content bg-dark">
      <div class="modal-header border-0">
        <h5 class="modal-title text-warning" id="post-original-titulo"></h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
          <i class="bi bi-x-lg fw-bold"></i>
        </button>
      </div>
      <div class="modal-body bg-secondary pt-0">

        <!-- Post original -->
        <div
          class="container d-flex align-items-center gap-3 p-1 sticky-top bg-secondary border-bottom border-warning mh-50">
          <div class="col-3 col-sm-2 p-0 p-lg-2">
            <img src="assets/img/default-poster.png" alt="poster" id="post-original-poster"
              class="container p-0 rounded border border-warning" />
          </div>
          <div class="container col-9 col-sm-10">
            <h4 id="post-original-usuario" class="text-warning"></h4>
            <p id="post-original-contenido" class="text-light text-truncate"></p>
            <span id="post-original-fecha" class="text-white-50"></span>
          </div>
        </div>
        <!-- Fin Post original -->
        <!-- Comentarios -->
        <div class="mb-3" id="comentarios-post"></div>
        <!-- Fin Comentarios -->
      </div>
      <form method="post" id="form-comentar">
        <input type="hidden" name="id-usuario" id="id-usuario" value="<?= $_SESSION["usuario"]->id ?>">
        <input type="hidden" name="id-post" id="id-post" value="">
        <div class="modal-footer border-0 d-flex flex-wrap justify-content-around px-0">
          <div class="col-9 col-sm-10">
            <textarea class="form-control" name="comentario" id="comentario" rows="2" placeholder="Comentario..."
              required></textarea>
          </div>
          <button id="btn-comentar" type="submit" class="col-2 col-sm-1 btn btn-outline-warning m-0">
            <i class="bi bi-send-fill"></i>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Fin Modal Comentarios -->