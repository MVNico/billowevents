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
    	          './html/bower_components/jquery/jquery.js',
    	          './html/bower_components/bootstrap/dist/js/bootstrap.js',
    	          './html/js/frontend.js'
    	        ],
    	        dest: './html/js/comp_frontend.js',
    	      },
    	      js_backend: {
    	        src: [
    	          './html/bower_components/jquery/jquery.js',
    	          './html/bower_components/bootstrap/dist/js/bootstrap.js',
    	          './html/js/backend.js'
    	        ],
    	        dest: './html/js/comp_backend.js',
    	      },
    	    },
	    less: {
        	development: {
                options: {
                  compress: true,  //minifying the result
                },
                files: {
                  //compiling frontend.less into frontend.css
                  "./html/css/frontend.css":"./html/stylesheets/frontend.less",
                  //compiling backend.less into backend.css
                  "./html/css/backend.css":"./html/stylesheets/backend.less"
                }
            }
        },
        uglify: {
            options: {
              mangle: false  // Use if you want the names of your functions and variables unchanged
            },
            frontend: {
              files: {
            	  '..'/html/js/frontend.js: './public/assets/javascript/frontend.js',
              }
            },
            backend: {
              files: {
                './public/assets/javascript/backend.js': './public/assets/javascript/backend.js',
              }
            },
          },
        phpunit{
          //...
        },
        watch{
          //...
        }
      });

    // Plugin loading

    // Task definition

  };