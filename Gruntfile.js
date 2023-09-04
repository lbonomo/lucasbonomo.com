/*
# Debug


# Dist
*.php    = Sincronizar
*.css    = en "dst"
*.js     = en "dst"
*.scss   = transcompilar style.scss > CSS en "dst"
imagenes = optimizar y copiar en "dst"

https://github.com/gruntjs/grunt-contrib-watch


*/
module.exports = function (grunt) {

  grunt.initConfig({

    browserSync: {
      dev: {
        bsFiles: {
          src: [
            'dst/**/*.{png,svg,php,css,js,txt,html,png,svg}'
          ]
        },
        options: {
          // server: { baseDir: "./" }
          watchTask: true,
          open: false,
          proxy: "https://lucasbonomo.lndo.site/"
        }
      }
    },

    uglify: {
      dist: {
        files: {
          './dst/assets/js/build.js': [
            'src/assets/js/*.js',
            '!src/assets/js/customizer.js', // Es para el backend de WordPress
            '!src/assets/js/build.js'
          ]
        }
      }
    },

    sync: {
      theme2019: {
        files: [{
          cwd: 'themes/lb-2019/src/',
          src: [
            '**/*.{png,svg,php,css,js,txt,html,png,svg}'
          ],
          dest: 'themes/lb-2019/dst/',
        }]
      },
      verbose: true, // Display log messages when copying files
      // pretend: true, // Don't do any IO. Before you run the task with `updateAndDelete` PLEASE MAKE SURE it doesn't remove too much.
      updateAndDelete: true, // Remove all files from dest that are not found in src. Default: false
      // compareUsing: "md5" // compares via md5 hash of file contents, instead of file modification ti
    },


    watch: {
      theme2019: {
        files: [
          'themes/lb-2019/src/**/*.{png,svg,php,css,js,txt,html,png,svg,scss}'
        ],
        tasks: [
          'sync:theme2019',
          'sass:theme2019'
        ],
      },
    },

    clean: {
      theme2019: {
        src: ['themes/lb-2019/dst/*']
      }
    },

    sass: {
      theme2019: {
        options: {
          style: 'expanded'
        },
        files: {
          'themes/lb-2019/dst/assets/css/style.css': 'themes/lb-2019/src/assets/sass/style.scss'
        }
      }
    }

  });

  grunt.loadNpmTasks('grunt-sync');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-browser-sync');
  grunt.loadNpmTasks('grunt-contrib-sass');

  grunt.registerTask('build', [
    'clean:theme2019',
    'sync:theme2019',
    'sass:theme2019'
  ]);

  grunt.registerTask('dev', [
    // 'browserSync:dev',
    'watch:theme2019'
  ]);

};
