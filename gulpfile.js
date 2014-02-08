var gulp = require('gulp'),
    sys = require('sys'),
    exec = require('child_process').exec;

gulp.task('phpunit', function() {
    console.log('Path is: '+eventPath);
    exec('phpunit '+eventPath, function(error, stdout) {
        sys.puts(stdout);
    });
});

gulp.task('default', function() {
    var watcher = gulp.watch('**/*.php', { debounceDelay: 2000 }, ['phpunit']);
	watcher.on('change', function(event){
		GLOBAL.eventPath = event.path;
	});
});
