"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
var schematics_1 = require("@angular-devkit/schematics");
var utils_1 = require("./utils");
var tasks_1 = require("@angular-devkit/schematics/tasks");
var style_options_1 = require("./models/style-options");
function default_1(_options) {
    return (0, schematics_1.chain)([
        addPackageJsonDependencies(_options),
        installPackageJsonDependencies(),
        updateAngularJsonFile(_options)
    ]);
}
exports.default = default_1;
function addPackageJsonDependencies(options) {
    return function (tree, context) {
        // Update package.json
        var styleDeps = style_options_1.ADT_SUPPORTED_STYLES.find(function (e) { return e.style == options.style; });
        var dependencies = [
            { version: '^3.6.0', name: 'jquery', isDev: false },
            { version: '^1.11.3', name: 'datatables.net', isDev: false },
            { version: '^3.5.9', name: '@types/jquery', isDev: true },
            { version: '^1.10.21', name: '@types/datatables.net', isDev: true }
        ];
        if (styleDeps) {
            if (styleDeps.style != style_options_1.ADTStyleOptions.DT)
                context.logger.log('warn', 'Your project needs Bootstrap CSS installed and configured for changes to take affect.');
            styleDeps.packageJson.forEach(function (e) { return dependencies.push(e); });
        }
        dependencies.forEach(function (dependency) {
            var result = (0, utils_1.addPackageToPackageJson)(tree, dependency.name, dependency.version, dependency.isDev);
            if (result) {
                context.logger.log('info', "\u2705\uFE0F Added \"".concat(dependency.name, "\" into \"").concat(dependency.isDev ? 'devDependencies' : 'dependencies', "\""));
            }
            else {
                context.logger.log('info', "\u2139\uFE0F  Skipped adding \"".concat(dependency.name, "\" into package.json"));
            }
        });
        return tree;
    };
}
function installPackageJsonDependencies() {
    return function (host, context) {
        context.addTask(new tasks_1.NodePackageInstallTask());
        context.logger.log('info', "\uD83D\uDD0D Installing packages...");
        return host;
    };
}
function updateAngularJsonFile(options) {
    return function (tree, context) {
        var styleDeps = style_options_1.ADT_SUPPORTED_STYLES.find(function (e) { return e.style == options.style; });
        var assets = [
            { path: 'node_modules/jquery/dist/jquery.min.js', target: 'scripts', fancyName: 'jQuery Core' },
            { path: 'node_modules/datatables.net/js/jquery.dataTables.min.js', target: 'scripts', fancyName: 'DataTables.net Core JS' },
        ];
        if (styleDeps) {
            styleDeps.angularJson.forEach(function (e) { return assets.push(e); });
        }
        assets.forEach(function (asset) {
            var result = (0, utils_1.addAssetToAngularJson)(tree, asset.target, asset.path);
            if (result) {
                context.logger.log('info', "\u2705\uFE0F Added \"".concat(asset.fancyName, "\" into angular.json"));
            }
            else {
                context.logger.log('info', "\u2139\uFE0F  Skipped adding \"".concat(asset.fancyName, "\" into angular.json"));
            }
        });
    };
}
//# sourceMappingURL=index.js.map