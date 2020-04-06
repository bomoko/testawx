#!/usr/bin/php
<?php

	if(count($argv) < 2)
	{
		echo "requires at least one argument\n";
		exit(1);
	}

	$graphdata = json_decode(file_get_contents($argv[1]));

	if($graphdata == FALSE)
	{
		echo "Input isn't json\n";
		exit(1);
	}

	foreach($graphdata->data->allProjects as $key => $project)
	{
		foreach($project->environments as $environment) {
			if($environment->name == 'prod') {
				echo "{$project->name} ansible_host=ssh.lagoon.amazeeio.cloud ansible_user={$environment->openshiftProjectName} ansible_port=32222\n";
			}
		}
	}
