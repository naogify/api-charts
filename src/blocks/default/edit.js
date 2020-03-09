import { ServerSideRender } from "@wordpress/components";
import { Fragment } from "@wordpress/element";
export const edit = props => {
  const { attributes } = props;
  return (
    <Fragment>
      <ServerSideRender block="api-charts/default" attributes={attributes} />
    </Fragment>
  );
};
