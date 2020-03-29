import { Fragment } from "@wordpress/element";
import apiFetch from "@wordpress/api-fetch";
import { ServerSideRender } from "@wordpress/components";
import { drawCharts } from "./drawCharts";

export const edit = props => {
  const { attributes } = props;
  drawCharts();
  return (
    <Fragment>
      <div id="chart_div">hey</div>
      {/* <ServerSideRender block="api-charts/default" attributes={attributes} /> */}
    </Fragment>
  );
};
