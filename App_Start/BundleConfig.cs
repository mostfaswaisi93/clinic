using System.Web;
using System.Web.Optimization;

namespace MyClinic
{
    public class BundleConfig
    {
        // For more information on bundling, visit https://go.microsoft.com/fwlink/?LinkId=301862
        public static void RegisterBundles(BundleCollection bundles)
        {
            //bundles.Add(new ScriptBundle("~/bundles/lib").Include(
            //            "~/Scripts/jquery-{version}.js",
            //            "~/Scripts/bootstrap.js",
            //            "~/scripts/bootbox.js",
            //            "~/scripts/sweetalert.min.js",
            //            "~/scripts/datatables/jquery.datatables.js",
            //            "~/scripts/datatables/datatables.bootstrap.js"));

            //bundles.Add(new ScriptBundle("~/bundles/jqueryval").Include(
            //            "~/Scripts/jquery.validate*"));

            //// Use the development version of Modernizr to develop with and learn from. Then, when you're
            //// ready for production, use the build tool at https://modernizr.com to pick only the tests you need.
            //bundles.Add(new ScriptBundle("~/bundles/modernizr").Include(
            //            "~/Scripts/modernizr-*"));

            //bundles.Add(new ScriptBundle("~/bundles/bootstrap").Include(
            //            "~/Scripts/bootbox.js",
            //            "~/Scripts/sweetalert.min.js",
            //            "~/Scripts/bootstrap.js"));

            //bundles.Add(new StyleBundle("~/Content/css").Include(
            //          "~/Content/bootstrap.css",
            //          "~/content/datatables/css/datatables.bootstrap.css",
            //          "~/Content/sweetalert2.min.css",
            //          "~/Content/site.css"));

            bundles.Add(new StyleBundle("~/Content/CSSSeffy").Include(
                "~/Seffy/js/simple-line-icons/simple-line-icons.min.css",
                "~/Seffy/css/font-awesome.min.css",
                "~/Seffy/js/bootstrap/css/bootstrap.min.css",
                "~/Seffy/js/bootstrap-switch/css/bootstrap-switch.min.css",
                "~/Seffy/js/fullcalendar/fullcalendar.css",
                "~/Seffy/js/dropzone/dropzone.css",
                "~/Seffy/js/datatables/jquery.dataTables.min.css",
                "~/Seffy/css/theme_style.css",
                "~/Content/select2.min.css",
                "~/Seffy/css/plugins.min.css",
                "~/content/sweetalert2/dist/sweetalert2.min.css",
                "~/Seffy/css/style.css",
                "~/Seffy/css/formlayout.css",
                "~/Seffy/css/responsive.css",
                "~/Seffy/css/theme-color.css",
                "~/Content/site.css"));

            bundles.Add(new StyleBundle("~/Content/CSSSeffy1").Include(
                "~/Content/themes/base/jquery-ui.min.css",
                "~/Content/select2.min.css",
                "~/Seffy/js/bootstrap-timepicker/css/bootstrap-timepicker.min.css",
                "~/Scripts/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css",
                "~/Content/line-awesome.min.css"));

            bundles.Add(new ScriptBundle("~/bundles/JSSeffy").Include(
                "~/Seffy/js/jquery.min.js",
                "~/Seffy/js/bootstrap/js/bootstrap.min.js",
                "~/Seffy/js/jquery.blockui.min.js",
                "~/Seffy/js/bootstrap-switch/js/bootstrap-switch.min.js",
                "~/Seffy/js/counterup/jquery.waypoints.min.js",
                "~/Seffy/js/counterup/jquery.counterup.min.js",
                "~/Seffy/js/datatables/datatables.min.js",
                "~/Seffy/js/datatables/plugins/bootstrap/datatables.bootstrap.js",
                "~/Seffy/js/moment.min.js",
                "~/Seffy/js/fullcalendar/fullcalendar.min.js",
                "~/Seffy/js/calendar.min.js",
                "~/Scripts/bootbox.js",
                "~/Scripts/select2.min.js",
                "~/content/sweetalert2/dist/sweetalert2.min.js",
                "~/content/sweetalert2/dist/sweetalert2.all.min.js",
                "~/Seffy/js/bootstrap-wizard/jquery.bootstrap.wizard.min.js",
                "~/Seffy/js/dropzone/dropzone.js",
                "~/Seffy/js/dropzone/dropzone-call.js",
                "~/Seffy/js/table_data.js",
                "~/Seffy/js/jquery.slimscroll.js",
                "~/Seffy/js/chart-js/Chart.bundle.js",
                "~/Seffy/js/chart-js/utils.js",
                "~/Seffy/js/theme-color.js",
                "~/Seffy/js/app.js",
                "~/Seffy/js/layout.js"
            ));

            bundles.Add(new ScriptBundle("~/bundles/JSSeffy1").Include(
                "~/Scripts/jquery-ui-1.12.1.min.js",
                "~/Scripts/select2.min.js",
                "~/Seffy/js/bootstrap-timepicker/js/bootstrap-timepicker.min.js",
                "~/Scripts/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"
            ));

            //BundleTable.EnableOptimizations = true;

        }
    }
}


