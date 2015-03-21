<section class="indice_crea">
    <h1>Créer un indice </h1>
    <br>

    <form action="traitement.php" method="post">
        <div class="form-group">
            <label for="num_indice">Numéro de l'indice :</label>
            <input type="number" class="form-control" id="num_indice" name="num_indice" required/>
        </div>
        <div class="form-group">
            <label for="prix">Points :</label>
            <input type="number"  class="form-control" id="prix" name="prix" required/>
        </div>
        <div class="form-group">
            <label for="ennonce">Ennoncé :</label>
            <textarea id="ennonce"  class="form-control" name="ennonce" required></textarea>
        </div>
        <div class="button btn_indice ">
            <button type="submit" type="button" class="btn btn-info">Créer l'indice</button>
        </div>
    </form>
</section>