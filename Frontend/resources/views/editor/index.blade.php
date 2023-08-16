<x-app-layout>
    <x-slot name="header">
            {{ __('Pokemon Editor') }}
    </x-slot>
    <div class="row">
        <div class="col-4">
            <h2>Add Pokemon</h2>
            <form method="post">
            @csrf
            <input type="hidden" name="action" value="create">
            <div class="mb-3">
                <label for='name'>Name</label>
                <input type="text" class="form-control" id='name' name='name' required>
            </div>
            <div class="mb-3">
                <label for='image'>Image URL</label>
                <input type="text" class="form-control" id='image' name='image'>
            </div>
            <div class="mb-3">
                <label for='weight'>Weight</label>
                <input type="text" class="form-control" id='weight' name='weight'>
            </div>
            <div class="mb-3">
                <label>Types</label>
                <?php foreach($data['types'] as $type) { ?>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name='type[]' id="ch<?=$type["id"]?>" value="<?=$type["id"]?>">
                    <label for="ch<?=$type["id"]?>" class="form-check-label"><?=$type["name"]?></label>
                </div>
                <?php } ?>
            </div>
            <?php if (isset($data['message'])) {?>
            <h5 class="w-100 text-center mb-3" style="color:<?=$data['messageColor']?>"><?=$data['message']?></h5>
            <?php } ?>

            <button class="btn btn-primary" type="submit">Add</button>
            </form>
            
        </div>
    </div>
    <hr>
    <div class="row">
        <h2>Remove Pokemon</h2>
        <?php foreach ($data['pokemons'] as $pokemon) { ?>
            <div class="card col-lg-2 col-md-2 col-sm-3 col-4">
                <img class="card-img-top" src="<?=$pokemon['image']?>">
                <div class="card-body">
                  <h3 class="card-title"><?=$pokemon['name']?></h3>
                  <h4 class="card-text"><?=count($pokemon['types']) ? "Type(s): " . implode(", ", $pokemon['types']) : ""?></h4>
                  <h4 class="card-text"><?=$pokemon['weight'] ? "Weight: {$pokemon['weight']}" : ''?></h4>
                  <form method="post">
                      @csrf
                      <input type="hidden" name="id" value="<?=$pokemon['id']?>">
                      <input type="hidden" name="action" value="delete">
                      <button type="submit" class="w-100 btn btn-secondary" onClick="return confirm('Are you sure?')">Remove</button>
                  </form>
                </div>        
        
            </div>
        <?php } ?>
    </div>
    
    </div>
</x-app-layout>
