module.exports = function( grunt ) {
grunt.initConfig({
pkg: grunt.file.readJSON('package.json'),
sass : {
dist : {
  options : { style : 'nested' },
  files : {
    'style.css' : 'style.scss'
  }
}
}, // sass
jade: {
 compile: {
   options: {
     pretty: true,
   },
   files: {
     'index.php':'index.jade'
   }
 }
},
watch : {
options: {
    livereload: true
},
	dist : {
    files : [
      '*.php',
       '*.jade',
      '*.css',
      '*.scss',
      'css/*.css',
      'js/*.js'
    ],
    tasks : ['sass', 'jade' ]
	}
}
});


// Plugins do Grunt
grunt.loadNpmTasks( 'grunt-contrib-sass' );
grunt.loadNpmTasks( 'grunt-contrib-watch' );
grunt.loadNpmTasks( 'grunt-contrib-pug' );
grunt.loadNpmTasks('grunt-contrib-jade');


// Tarefas que serão executadas
grunt.registerTask( 'default', ['sass', 'watch', 'pug', 'jade']);
};