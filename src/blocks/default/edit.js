import { Fragment } from "@wordpress/element";
import apiFetch from "@wordpress/api-fetch";

export const edit = props => {
  const { attributes } = props;
  drawCharts();
  return (
    <Fragment>
      <div id="chart_div">Hello</div>
    </Fragment>
  );
};

export const drawCharts = () => {
  apiFetch({
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
  });
};
