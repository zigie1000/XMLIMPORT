<div class="alert alert-success" {if empty($success)}style="display:none;"{/if}>
    {$success}
</div>

<div class="alert alert-danger" {if empty($errors)}style="display:none;"{/if}>
    {foreach from=$errors item=error}
        <p>{$error}</p>
    {/foreach}
</div>

<div class="alert alert-warning" {if empty($warnings)}style="display:none;"{/if}>
    {foreach from=$warnings item=warning}
        <p>{$warning}</p>
    {/foreach}
</div>
