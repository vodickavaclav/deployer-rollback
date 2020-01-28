<?php

namespace vavo\Deployer;

task('rollback', function () {
	$revision = input()->getOption('revision');

	$releases = get('releases_list');
	$rollbackRelease = null;
	$rollbackReleaseDir = null;
	foreach ($releases as $release) {
		$releaseDir = "{{deploy_path}}/releases/{$release}";
		$commitHash = trim(run("cd $releaseDir && git rev-parse HEAD"));
		if ($commitHash === $revision) {
			$rollbackRelease = $release;
			$rollbackReleaseDir = $releaseDir;
			break;
		}
	}
	if ($rollbackRelease !== null && $rollbackReleaseDir !== null) {
		// Symlink to old release.
		run("cd {{deploy_path}} && {{bin/symlink}} $rollbackReleaseDir current");
		if (isVerbose()) {
			writeln("Rollback to `{$rollbackRelease}` release was successful.");
		}
	} else {
		writeln("<comment>You can not revert to this revision.</comment>");
	}
});