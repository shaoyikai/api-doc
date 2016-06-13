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
                <td>45ee4</td>
                <td>0</td>
                <td>0</td>
                <td>4545</td>
                <td>
                    <a href="javascript:void(0)" onclick="removeParams(5)" className="btn btn-warning">-</a>

                </td>
            </tr>
        );
    }
});

var ParamsTable = React.createClass({
    render: function() {
        return React.createElement('table',{className:"table table-bordered"},
            <tbody>
                <ParamsThead />
                <ParamsTr />
            </tbody>
        );
    }
});

var box = document.getElementById('params-box');
ReactDOM.render(<ParamsTable />,box);


