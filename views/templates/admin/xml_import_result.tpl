{if $success}
    <div class="conf">
        {$lang.import_success_message}
    </div>
{else}
    <div class="error">
        {$lang.import_error_message}
    </div>
    <ul>
        {foreach from=$errors item=error}
        <li>{$error}</li>
        {/foreach}
    </ul>
{/if}
