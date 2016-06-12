/**
 * Created by yikai on 2016-6-12.
 * react jsx file
 */

var ParamsThead = React.createClass({
    render: function() {
        return (
            <tr>
                <th>参数</th>
                <th>类型</th>
                <th>是否可选</th>
                <th>说明</th>
                <th>操作</th>
            </tr>
        );
    }
});

var ParamsTr = React.createClass({
    render: function() {
        return (
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        );
    }
});

var ParamsTable = React.createClass({
    render: function() {
        return (
            <table class="table table-bordered">
                <ParamsThead />
                <ParamsTr />
            </table>
        );
    }
});

ReactDOM.render(
    <ParamsTable />,
    document.getElementById('params-box')
);


