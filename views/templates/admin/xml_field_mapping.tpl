<form action="{$currentIndex}&token={$token}" method="post">
    <fieldset>
        <legend>{$lang.mapping_legend}</legend>

        {foreach from=$xmlFields item=field}
        <label>{$field.name}</label>
        <div class="margin-form">
            <select name="mapping[{$field.name}]">
                {foreach from=$prestashopFields item=psField}
                <option value="{$psField.id}">{$psField.name}</option>
                {/foreach}
            </select>
        </div>
        {/foreach}

        <div class="margin-form">
            <input type="submit" name="saveMapping" value="{$lang.save_mapping}" class="button" />
        </div>
    </fieldset>
</form>
