<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
  <button type="button" class="btn btn-secondary rounded-0">Agenda</button>
  <button type="button" class="btn btn-secondary rounded-0">Módulos</button>
  <button type="button" class="btn btn-secondary rounded-0">Seguridad</button>
  <button type="button" class="btn btn-secondary rounded-0">Personalización</button>
  <button type="button" class="btn btn-secondary rounded-0">Contabilidad</button>
  <button type="button" class="btn btn-secondary rounded-0">Maestros</button>
  <div class="btn-group dropright">
    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Domicilio
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="?controller=Estado&action=ListarEstado">Estado</a>
      <a class="dropdown-item" href="?controller=Municipio&action=ListarMunicipio">Municipio</a>
      <a class="dropdown-item" href="?controller=Parroquia&action=ListarParroquia">Parroquia</a>
      <a class="dropdown-item" href="?controller=Ciudad&action=ListarCiudad">Ciudad</a>

    </div>
  </div>
</div>