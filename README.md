<h1>EasyHealth<h1>
<h2>Getting Started</h2>
<p>
	This product prototype will help patients get immediate medical facilities at their doorstep, resulting making a healthcare way easier than previous.
</p>

<h3>Prerequisites</h3>
<pre>
<code>
- Docker
- Docker composer
</code>
</pre>
Compose is a tool for defining and running multi-container Docker applications. With Compose, you use a YAML file to configure your application’s services. Then, with a single command, you create and start all the services from your configuration.

<h3>Installing</h3>
<pre><code>
- Clone repository
	git clone git@bitbucket.org:ankit_kumbhar/easy_health.git

- Run docker
	docker-compose up -d

- Update composer.json
	composer update

- Create .env file and add docker container names in DB_CONNECTION
	Example
		DB_CONNECTION=mysql

- Installing passport (It will generate passport keys)
	php artisan passport:install
</code></pre>

<h3>Documentations</h3>
<ul>
	<li>
		<a href="https://laravel.com/docs/5.7">Laravel Documentation</a>
	</li>
	<li>
		<a href="https://github.com/asahasrabuddhe/laravel-api">Laravel api package</a>
	</li>
	<li>
		<a href="https://docs.docker.com/compose/">Docker Compose</a>
	</li>
	<li>
		<a href="https://laravel.com/docs/5.7/passport">Passport</a>
	</li>
</ul>
<hr>