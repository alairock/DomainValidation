var gulp = require('gulp');
var sys = require('sys');
var exec = require('child_process').exec;
var notify = require("gulp-notify");


gulp.task('phpunit', function() {
    console.log('Path is: '+eventPath);
    exec('phpunit '+eventPath, function(error, stdout) {
        if (!error) {
            sys.puts(stdout);
            gulp.src(eventPath)
                .pipe(notify({title: 'Test is Okay', message: 'Test at ' + eventPath + 'Passed'}));
        } else {
            sys.puts(stdout);
            gulp.src(eventPath)
                .pipe(notify({title: 'Test Failed!', message: 'Test at ' + eventPath + 'Failed'}));
        }
    });
});

gulp.task('default', function() {
    var watcher = gulp.watch('test/**/*.php', { debounceDelay: 2000 }, ['phpunit']);
	watcher.on('change', function(event){
		GLOBAL.eventPath = event.path;
	});
});
