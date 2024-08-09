<div class="form-group">
    <label for="xmlField">XML Field</label>
    <select name="xml_field" id="xmlField" class="form-control">
        {foreach from=$xml_fields item=field}
            <option value="{$field}">{$field}</option>
        {/foreach}
    </select>
</div>

<div class="form-group">
    <label for="psField">PrestaShop Field</label>
    <select name="ps_field" id="psField" class="form-control">
        {foreach from=$ps_fields item=field}
            <option value="{$field}">{$field}</option>
        {/foreach}
    </select>
</div>

<div class="form-group">
    <label for="mappingTemplate">Save as Template</label>
    <input type="text" name="mapping_template" id="mappingTemplate" class="form-control" value="{$mapping_template|escape:'html':'UTF-8'}">
</div>

<div class="form-group">
    <button type="submit" name="save_mapping" class="btn btn-primary">Save Mapping</button>
</div>
