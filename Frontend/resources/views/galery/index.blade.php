<x-app-layout>
    <x-slot name="header">
            {{ __('Pokemon List') }}
    </x-slot>
    <div class="row">
        <div class="col-4">
            <h2>Filter</h2>
            <form>
            <div class="mb-3">
                <label for='search_text'>Pokemons' name (at least 3 letters)</label>
                <input type="text" class="form-control" id='search_text' name='search_text' value="<?=isset($filter['search_text']) ? $filter['search_text'] : ""?>" minlength="3">
            </div>
            
            <div class="mb-3">
                <label for='filter_type'>Type of Pokemon</label>
                <select name='filter_type' class="form-select">
                    <option value=""<?=(isset($filter['filter_type']) && !$filter['filter_type']) ? " selected" : ""?>>Select</option>
                <?php foreach ($data["types"] as $k => $v) { ?>
                    
                    <option value="<?=$v['id']?>"<?=(isset($filter['filter_type']) && $filter['filter_type'] == $v['id']) ? " selected" : ""?>>
                      <?=$v['name']?>
                    </option>
                <?php } ?>
                </select>
            </div>
            <button class="btn btn-primary" type="submit">Search</button>
            <a class="btn btn-secondary" href="/">Reset</a>
            </form>
        </div>
    </div>
    <hr>
    <?php if (isset($data['message'])) {?>
    <div class="row"><div class="col-12"><h4 style="color:red"><?=$data['message']?></h4></div></div>
    <?php } ?>
    <div class="row">
        <?php foreach ($data['pokemons'] as $pokemon) { ?>
            <div class="card col-lg-2 col-md-2 col-sm-3 col-4">
                <img class="card-img-top" src="<?=$pokemon['image']?>">
                <div class="card-body">
                  <h3 class="card-title"><?=$pokemon['name']?></h3>
                  <h4 class="card-text"><?=count($pokemon['types']) ? "Type(s): " . implode(", ", $pokemon['types']) : ""?></h4>
                  <h4 class="card-text"><?=$pokemon['weight'] ? "Weight: {$pokemon['weight']}" : ''?></h4>
                </div>        
        
            </div>
        <?php } ?>
    </div>
    
    </div>
</x-app-layout>
