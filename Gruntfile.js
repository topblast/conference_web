module.exports = function(grunt) {
	

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    
	jsdoc: {
    dist: {
      src: ['public/js'],
      options: {
        destination: 'build/docs',
        configure: 'node_modules/angular-jsdoc/common/conf.json',
        template: 'node_modules/angular-jsdoc/angular-template',
        tutorial: 'tutorials',
        readme: 'README.md'
      }
    }
  }
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-jsdoc');

  // Default task(s).
  grunt.registerTask('default', ['jsdoc']);

};