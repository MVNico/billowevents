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
    	          'bower_components/moment/min/moment-with-locales.min.js',
    	          'bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
    	          'js/own_frontend.js'
    	        ],
    	        dest: 'js/frontend.js',
    	      },
    	      js_backend: {
    	        src: [
    	          'bower_components/jquery/dist/jquery.js',
    	          'bower_components/bootstrap/dist/js/bootstrap.js',    	          
    	          'bower_components/jquery-validation/dist/jquery.validate.min.js',
    	          'bower_components/moment/min/moment-with-locales.min.js',
    	          'bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
    	          'js/own_backend.js'
    	        ],
    	        dest: 'js/backend.js',
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
              mangle: false
            },
           min_frontend: {
        	   files: {
        		   "js/min_frontend.js":["js/frontend.js"]
        	   	}
    	   }
          },
        phpunit: {
          //...
        },
        watch: {
          //...
        	js: {
        		files: ['js/own_frontend.js'],
        		tasks: ['concat', 'uglify']
        	},
	        less: {
	        	files: ['stylesheets/frontend.less'],
	        	tasks: ['less']
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
      	grunt.registerTask('default', ['less', 'concat', 'uglify']);

  };