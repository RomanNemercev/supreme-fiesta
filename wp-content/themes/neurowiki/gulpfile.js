const { src, dest, watch, series, parallel } = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const postcss = require("gulp-postcss");
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const concat = require("gulp-concat");
const uglify = require("gulp-uglify");
const browserSync = require("browser-sync").create();
const rename = require("gulp-rename");
const notify = require("gulp-notify");
const sourcemaps = require("gulp-sourcemaps");
const del = require("del");
const stylelint = require("gulp-stylelint");

// Путь к файлам
const paths = {
  scss: {
    src: "assets/scss/style.scss",
    watch: "assets/scss/**/*.scss",
    dest: "assets/css/",
  },
  js: {
    src: "assets/js/src/**/*.js",
    dest: "assets/js/dist/",
  },
  img: {
    src: "assets/img/src/**/*.{jpg,png,gif,svg}",
    dest: "assets/img/dist/",
  },
};

// Задача для компиляции SCSS
function styles() {
  return src(paths.scss.src)
    .pipe(sourcemaps.init())
    .pipe(sass().on("error", sass.logError)) // Обработка ошибок
    .pipe(sass().on("error", notify.onError("Error: <%= error.message %>")))
    .pipe(postcss([autoprefixer(), cssnano()])) // Автопрефиксы и минификация
    .pipe(rename("style.min.css"))
    .pipe(sourcemaps.write("."))
    .pipe(dest(paths.scss.dest))
    .pipe(browserSync.stream()); // Обновление браузера
}

// Задача для обработки JS
function scripts() {
  return src(paths.js.src)
    .pipe(concat("main.min.js")) // Объединяем в один файл
    .pipe(uglify()) // Минификация JS
    .pipe(dest(paths.js.dest))
    .pipe(browserSync.stream());
}

// Задача для BrowserSync
function browserSyncServe(cb) {
  browserSync.init({
    proxy: "http://neurowiki.local/", // Укажи URL твоего локального сервера
    notify: false,
  });
  cb();
}

function browserSyncReload(cb) {
  browserSync.reload();
  cb();
}

// Задача для отслеживания изменений
function watchFiles() {
  watch(paths.scss.watch, styles);
  watch(paths.js.src, scripts);
  watch("**/*.php", browserSyncReload); // Перезагрузка при изменении PHP
}

function clean() {
  return del([
    paths.scss.dest + "style.min.css",
    paths.js.dest + "main.min.js",
  ]);
}

function lintStyles() {
  return src(paths.scss.watch).pipe(
    stylelint({
      reporters: [{ formatter: "string", console: true }],
    })
  );
}

// Основные задачи
exports.styles = styles;
exports.scripts = scripts;
exports.watch = series(browserSyncServe, watchFiles);
exports.default = series(
  parallel(styles, scripts),
  browserSyncServe,
  watchFiles
);
exports.clean = clean;
exports.default = series(
  clean,
  parallel(styles, scripts),
  browserSyncServe,
  watchFiles
);
exports.lintStyles = lintStyles;
