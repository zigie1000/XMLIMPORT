<div class="form-group">
    <label for="savedTemplates">Saved Templates</label>
    <select name="saved_template" id="savedTemplates" class="form-control">
        {foreach from=$saved_templates item=template}
            <option value="{$template.id}">{$template.name}</option>
        {/foreach}
    </select>
</div>

<div class="form-group">
    <button type="submit" name="apply_template" class="btn btn-primary">Apply Template</button>
    <button type="submit" name="delete_template" class="btn btn-danger">Delete Template</button>
</div>
