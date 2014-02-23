module.exports = function (grunt) {

	// Initialize configuration object
	grunt.initConfig({

		// Read in project settings
		pkg: grunt.file.readJSON('package.json'),

		// User editable project settings & variables
		options: {
			// Base path to your assets folder
			base: 'assets',

			// Published assets path
			publish: 'public/assets',

			// Files to be clean on rebuild
			clean: {
				all: ['<%= options.css.concat %>', '<%= options.css.min %>','<%= options.js.min %>', '<%= options.js.concat %>'],
				concat: ['<%= options.css.concat %>', '<%= options.js.concat %>']
			},

			// CSS settings
			css: {
				base: 'assets/css',			 				// Base path to your CSS folder
				files: ['assets/css/bootstrap.css',
						'assets/css/bootstrap-responsive.css',
						'assets/css/dropzonejs.css',
						'assets/css/main.css'],							// CSS files in order you'd like them concatenated and minified
				concat: '<%= options.css.base %>/concat.css',	// Name of the concatenated CSS file
				min: '<%= options.publish %>/style.min.css'		// Name of the minified CSS file
			},

			// JavaScript settings
			js: {
				base: 'assets/js',							// Base path to you JS folder
				files: ['assets/js/vendor/bootstrap.min.js',
						'assets/js/vendor/idangerous.swiper-2.1.min.js',
						'assets/js/vendor/screenfull.min.js',
						'assets/js/plugins.js',
						'assets/js/main.js',
						'assets/js/admin.js'],					// JavaScript files in order you'd like them concatenated and minified
				concat: '<%= options.js.base %>/concat.js',		// Name of the concatenated JavaScript file
				min: '<%= options.publish %>/script.min.js'		// Name of the minified JavaScript file
			},

			// Notification messages
			notify: {
				watch: {
					title: 'Live Reloaded!',
					message: 'Files were modified, recompiled and site reloaded'
				}
			},

			// Files and folders to watch for live reload and rebuild purposes
			watch: {
				files: ['<%= options.js.files %>', '<%= options.css.files %>', '<%= options.less.base %>/*.less',
				 '<%= options.sass.base %>/*.sass', '<%= options.stylus.base %>/*.styl',
				 '!<%= option.js.min %>', '!<%= options.less.compiled %>', '!<%= options.sass.compiled %>', '!<%= options.stylus.compiled %>']
			}
		},

		// Clean files and folders before replacement
		clean: {
			all: {
				src: '<%= options.clean.all %>'
			},
			concat: {
				src: '<%= options.clean.concat %>'
			}
		},

		// Concatenate multiple sets of files
		concat: {
			css: {
				files: {
					'<%= options.css.concat %>' : ['<%= options.css.files %>']
				}
			},
			js: {
				options: {
					block: true,
					line: true,
					stripBanners: true
				},
				files: {
					'<%= options.js.concat %>' : '<%= options.js.files %>',
				}
			}
		},

		// Minify and concatenate CSS files
		cssmin: {
			minify: {
	       		src: '<%= options.css.concat %>',
	        	dest: '<%= options.css.min %>'
			}
		},

		// Javascript linting - JS Hint
		jshint: {
			files: ['<%= options.js.files %>'],
			options: {
				// Options to override JSHint defaults
				curly: true,
				indent: 4,
				trailing: true,
				devel: true,
				globals: {
					jQuery: true
				}
			}
		},

		// Display notifications
		notify: {
			watch: {
				options: {
					title: '<%= options.notify.watch.title %>',
					message: '<%= options.notify.watch.message %>'
				}
			}
		},

		// Javascript minification - uglify
		uglify: {
			options: {
				preserveComments: false
			},
			files: {
				src: '<%= options.js.concat %>',
				dest: '<%= options.js.min %>'
			}
		},

		// Watch for files and folder changes
		watch: {
			options: {
				livereload: true
			},
			files: '<%= options.watch.files %>',
			tasks: ['default', 'notify:watch']
		}


	});

	// Load npm tasks
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-compress');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-livereload');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-notify');

	// Register tasks
	grunt.registerTask('default', ['clean:all',  'concat:css', 'concat:js', 'cssmin', 'uglify', 'clean:concat']); // Default task
}
