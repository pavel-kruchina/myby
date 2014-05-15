{foreach from=$projects.records item=project}
        {include file='application.modules.public.views.blocks.project_row'}
{/foreach}