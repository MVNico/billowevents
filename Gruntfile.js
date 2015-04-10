//Gruntfile
    module.exports = function(grunt) {

    //Initializing the configuration object
      grunt.initConfig({

        // Task configuration
    	  concat: {
    	      options: {
    	        separator: ';',
    	      },
    	      js_frontend: {
    	        src: [
    	          'bower_components/jquery/dist/jquery.js',
    	          'bower_components/bootstrap/dist/js/bootstrap.js',
    	          'bower_components/jquery-validation/dist/jquery.validate.js',
    	          'bower_components/jquery-validation/src/localization/messages_de.js',
    	          'js/frontend.js'
    	        ],
    	        dest: 'js/comp_frontend.js',
    	      },
    	      js_backend: {
    	        src: [
    	          'bower_components/jquery/dist/jquery.js',
    	          'bower_components/bootstrap/dist/js/bootstrap.js',    	          
    	          'bower_components/jquery-validation/dist/jquery.validate.min.js',
    	          'js/backend.js'
    	        ],
    	        dest: 'js/comp_backend.js',
    	      },
    	    },
	    less: {
        	development: {
                options: {
                  compress: true,  //minifying the result
                },
                files: {
                  //compiling frontend.less into frontend.css
                  "css/frontend.css":"stylesheets/frontend.less",
                  //compiling backend.less into backend.css
                  "css/backend.css":"stylesheets/backend.less"
                }
            }
        },
        uglify: {
            options: {
              mangle: false  // Use if you want the names of your functions and variables unchanged
            },
            frontend: {
              files: {
            	  './html/js/frontend.js': './public/assets/javascript/frontend.js',
              }
            },
            backend: {
              files: {
                './public/assets/javascript/backend.js': './public/assets/javascript/backend.js',
              }
            },
          },
        phpunit: {
          //...
        },
        watch: {
          //...
        	src: {
        		files: ['js/frontend.js'],
        		tasks: ['concat']
        	}
        }
      });

    // Plugin loading
      grunt.loadNpmTasks('grunt-contrib-concat');
      grunt.loadNpmTasks('grunt-contrib-less');
      grunt.loadNpmTasks('grunt-contrib-uglify');
      grunt.loadNpmTasks('grunt-contrib-watch');
    // Task definition
      //default
      	grunt.registerTask('default', ['less', 'concat']);

  };