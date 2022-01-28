<script>
    import {API} from '../../../../settings';
    import {onMount} from "svelte";
    import {checkAuthLogin} from "../../../../lib/utils/checkAuthLogin";

    let ItemName = '';
    let ItemNames = '';
    let result;
    let quantity;
    let elem;
    let dropdown = document.getElementsByClassName("dropdown-content");
    let allItems = '';

    async function search() {
        const response = await fetch(API.url + API.version + 'consumables/get_items', {
            method: "POST",
            body: JSON.stringify({
                ItemName
            }),
            headers: {
                'Content-Type': 'application/json',
            },
        });
        result = await response.json();
        if (response.ok && result.success === true) {
            ItemNames = result.body
        }
    }

    async function get_all() {
        const response = await fetch(API.url + API.version + 'consumables/items/find?search=all', {
            method: "GET",
        });
        result = await response.json();
        if (response.ok && result.success === true) {
            allItems = result.body
        }
    }

    async function send() {
        let element = document.getElementsByClassName("data-list-item-value")[0];
        let ItemId = element.getAttribute('data-id');


        console.log(ItemId);
        console.log(quantity);
    }

    onMount(function () {
        get_all();
    });

</script>
<style>
    .items {
        padding: 5px;
        border: 1px solid black;
    }
    .items p {

    }
</style>
<div class="container-fluid">
    <h2 class="mt-2">Расходники</h2>
    <form>
        <div class="row">
            <div class="col-4">
                        <label for="itemName" class="form-label">Название товара</label>
                        <input bind:value={ItemName} type="text" on:input={search} class="form-control" id="itemName"
                               list="itemNames" placeholder="Поиск от 3-х символов">
                {#if ItemName.length >= 3}
                    <datalist id="itemNames">
                            {#each ItemNames as item}
                                <option  class="data-list-item-value" data-id={item.id} value="{item.name}">{item.name}</option>
                            {/each}
                    </datalist>
                {/if}
            </div>
            <div class="col-1">
                <label for="qnty" class="form-label">Кол-во</label>
                <input id="qnty" bind:value={quantity} class="form-control" type="number" required aria-label="qnty">
            </div>
        </div>
        <input on:click|preventDefault={send} type="submit" class="btn btn-primary mt-2" value="Добавить">
    </form>
    <div class="mt-3">
        <h3>Текущие вещи</h3>
    </div>
    {#each allItems as items}
         <div class="items"><p>{items.name}</p></div>
    {/each}
</div>




