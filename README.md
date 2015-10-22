# yii2-basic-sintret
template for yii2 basic

<h2><a id="user-content-installing-with-orion-cli" class="anchor" href="#installing-with-orion-cli" aria-hidden="true"><span class="octicon octicon-link"></span></a>Installation</h2>
<div class="highlight highlight-source-shell"><pre>composer create-project sintret/yii2-basic-sintret your-folder-directory-name</pre></div>

<h2><a id="user-content-installing-with-orion-cli" class="anchor" href="#installing-with-orion-cli" aria-hidden="true"><span class="octicon octicon-link"></span></a>Migrations</h2>
<div class="highlight highlight-source-shell"><pre>yii migrate</pre></div>


<h2><a id="user-content-installing-with-orion-cli" class="anchor" href="#installing-with-orion-cli" aria-hidden="true"><span class="octicon octicon-link"></span></a>Login Access</h2>
<div class="highlight highlight-source-shell"><pre>Username: admin Password:123456</pre></div>

<h2><a id="user-content-installing-with-orion-cli" class="anchor" href="#installing-with-orion-cli" aria-hidden="true"><span class="octicon octicon-link"></span></a>Configuration</h2>
<p>No Need RBAC, access control in your database Role, Please Open your Role Model and add Model like these following:</p>
<div class="highlight highlight-source-shell"><pre>public static $controllers = [
        'Log-Upload', 'Setting', 'Notification', 'User','Chat','Role','Test'
    ];</pre></div>
