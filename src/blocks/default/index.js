import { registerBlockType } from "@wordpress/blocks";
import { addFilter } from "@wordpress/hooks";
import { Fragment } from "@wordpress/element";
import domReady from "@wordpress/dom-ready";
import { edit } from "./edit";

registerBlockType("api-charts/default", {
  title: "Basic Example",
  icon: "smiley",
  category: "layout",
  attributes: {
    className: {
      type: "string",
      default: ""
    }
  },
  edit,
  save(props) {
    return (
      <Fragment>
        <script>
          {domReady(function() {
            alert("hellooooo");
          })}
          {/* {apiFetch({
            path: "/api-charts/v1/data-table/",
            method: "GET",
            parse: true
          }).then(jsonData => {
            // Load the Visualization API and the piechart package.
            google.charts.load("current", { packages: ["corechart"] });

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
              // Create our data table out of JSON data loaded from server.
              var data = new google.visualization.DataTable(jsonData);

              // Instantiate and draw our chart, passing in some options.
              var chart = new google.visualization.PieChart(
                document.getElementById("chart_div")
              );
              chart.draw(data, { width: 400, height: 240 });
            }
          })} */}
        </script>
        <div>hello</div>
      </Fragment>
    );
    // return edit(props);
  }
});
