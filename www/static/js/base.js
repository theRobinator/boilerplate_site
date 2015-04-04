/**
 * @fileoverview Simple implementation of providing functions so that namespaces
 * can be easily declared. Since no require framework is implemented, this file
 * should be replaced if you plan on doing that.
 */

goog = (window.goog || {});

/**
 * Dummy for goog.provide that only creates the provided namespace without any
 * require graph information.
 * @param {string} name Namespace provided by this file in the
 *                      form "namespace.package.part".
 */
goog.provide = function(name) {
    var namespaceParts = name.split('.');
    var currPointer = window;
    for (var i = 0; i < namespaceParts.length; ++i) {
        var part = namespaceParts[i];
        if (currPointer[part] == undefined) {
            currPointer[part] = {};
        }
        currPointer = currPointer[part];
    }
};
