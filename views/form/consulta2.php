<h3 align="center"> Propuestas de vuelo aceptadas entre codigos ICAO de los aeródromos</h3>

<form align="center" action="queries/consulta2.php" method="post" id="consulta2">
    <div class="has-text-centered">
        <div class="field">
            <p>código origen:</p>
            <div class="control has-icons-left limitado">
                <input class="input is-rounded is-small" type="text" name="codigo_origen" placeholder="Ej: LIRRF" autofocus="autofocus">
                <span class="icon is-small is-left">
          <i class="fa fa-search"></i>
        </span>
            </div>
        </div>
        <p>código destino:</p>
        <div class="control has-icons-left limitado">
            <input class="input is-rounded is-small" type="text" name="codigo_llegada" placeholder="Ej: LIRRF" autofocus="autofocus">
            <span class="icon is-small is-left">
        <i class="fa fa-search"></i>
      </span>
        </div><br>

        <div class="actions">
            <input type="submit" value="Buscar" class="button is-link">
        </div>
    </div>
</form>