{extends file="layout.tpl"}
{block name="body"}
    <div class="column column-1">
        <h1>Latest Downloads</h1>
        {if $builds}
            <table>
                <thead>
                    <tr>
                        <th>Cards</th>
                        <th>Time</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$builds item="build"}
                        <tr>
                            <td class="cards">
                                {$build->num}
                            </td>
                            <td>
                                {$build->name}
                            </td>
                            <td>
                                <a href="{$smarty.const.APP_URL}builds/download/{$build->id}/">
                                    Download
                                </a>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        {else}
            No builds yet.
        {/if}
    </div>
    <div class="column column-2">
        <h1>Issues</h1>
        <p>
            Is the current list out of date?
            <a
                href="{$smarty.const.APP_URL}builds/request/"
            >Request a rebuild</a>.

            <span class="progress">
                <span class="bar" style="width: {$request_percent * 100}%;"></span>
                <span class="caption">Rebuild status</span>
            </span>
        </p>
        <h1>Contact</h1>
        <p>
            <form action="{$smarty.const.APP_URL}message/" method="post">
                <fieldset>
                    {if $sent}
                        Your message has been sent!
                    {else}
                        <textarea
                            name="message"
                            rows="5"
                            cols="30"
                        ></textarea>
                        <input type="submit" value="Send" />
                    {/if}
                </fieldset>
            </form>
        </p>
    </div>
    <div class="clearfix"></div>
{/block}
