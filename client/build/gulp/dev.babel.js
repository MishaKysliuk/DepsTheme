import gulp from 'gulp'

import { P as p, R as r } from '../paths'

import Copy from './tasks/copy'
import Stylus from './tasks/stylus'

// //Include plugins
// const uncss = require('gulp-uncss')

// //Rename is included to rename the uncssed file
// const rename = require('gulp-rename')

// import Pug from './tasks/pug'

// import SvgFont from './tasks/svgfonts'
// import ImageMin from './tasks/imagemin'

// let imagemin = new ImageMin({
//   src: p.dest.public,
// })

// let svgfonts = new SvgFont({
//   src: `${p.src.public}svg/*.svg`,
//   glob: `${p.src.public}**/*.svg`,
//   dest: `${p.dest.public}fonts/`,
//   styl: `${p.src.stylus}project/`
// })

let pub = new Copy({
  src: [`${p.src.public}**/*`, `!${p.src.public}svg/`],
  glob: [`${p.src.public}**/*`, `!${p.src.public}svg/`],
  dest: p.dest.public
})

let stylus = new Stylus({
  src: `${p.src.stylus}style.styl`,
  glob: `${p.src.stylus}**/*.styl`,
  dest: p.dest.stylus
})


// let template_src = [
//   `${p.src.pug}templates/**/*.pug`,
//   `!${p.src.pug}templates/**/_*.pug`,
// ]
// let templates = new Pug({
//   src: template_src,
//   basedir: `${p.src.pug}templates/`,
//   // glob: template_src,
//   dest: p.dest.pug,
//   extension: '.html',
// })


// gulp.task('svgfonts', svgfonts.binded('dev'))
gulp.task('public', pub.binded('dev'))
gulp.task('stylus', stylus.binded('dev'))
// gulp.task('templates', templates.binded('dev'))


gulp.task('public:build', pub.binded('build'))
gulp.task('stylus:build', stylus.binded('build'))
// gulp.task('templates:build', templates.binded('build'))
// gulp.task('imagemin:build', imagemin.binded('build'))

// gulp.task('watch', ['svgfonts', 'public', 'stylus', 'templates'], (done) => {
gulp.task('watch', ['public', 'stylus'], (done) => {
  // svgfonts.watch('svgfonts')
  pub.watch('public')
  stylus.watch('stylus')
  // templates.watch('templates')
  done()
})

gulp.task('build', [
  // 'public:build', 'stylus:build', 'templates:build', 'imagemin:build'
  'public:build', 'stylus:build'
])

gulp.task('default', ['watch'])


// //Uncss task
// gulp.task('uncss', function () {
// //Where the bloated CSS lives
//   gulp.src(`${p.dest.public}/css/style.css`)
//     .pipe(uncss({ 
//       html: [ 
//         'http://casino.loc/paypal-casinos/',
//       ]
//     }))  
//   //Add a suffix to avoid confusion      
//     .pipe(rename({suffix: '.clean'}))
//   //The destination of new uncssed file
//     .pipe(gulp.dest(`${p.dest.public}/uncss/`))
// })
