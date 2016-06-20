

var ParamsTr = React.createClass({

    removeParams:function(){
        console.log(this);
    },
    render: function() {
        return (
            <tr>
                <td>{this.props.parm_name}</td>
                <td>{this.props.parm_type}</td>
                <td>{this.props.parm_must}</td>
                <td>{this.props.parm_desc}</td>
                <td>
                    <a href="javascript:void(0)" onClick={this.removeParams.bind(this)} className="btn btn-warning">-</a>
                </td>
            </tr>
        );
    }
});

var ParamsTrNew = React.createClass({
    render: function() {
        return (
            <tr>
                <td><input type="text" id="par_id" placeholder="请输入名称"/></td>

                <td>
                    <select id="par_type">
                        <option value="0" selected>string</option>
                        <option value="1">int</option>
                    </select>
                </td>

                <td>
                    <select id="par_must">
                        <option value="0" selected>是</option>
                        <option value="1">否</option>
                    </select>
                </td>

                <td><input type="text" id="par_desc" placeholder="请输入描述"/></td>

                <td>
                    <a href="javascript:void(0)" onclick="addParams()" className="btn btn-success">+</a>
                </td>
            </tr>
        );
    }
});
var ParamsTable = React.createClass({
    render: function() {
        return (
            <table className="table table-bordered">
                <tbody>
                    <tr>
                        <th>参数</th>
                        <th>类型</th>
                        <th>是否可选</th>
                        <th>说明</th>
                        <th>操作</th>
                    </tr>
                    <ParamsTr parm_name="nameee" parm_type="ddfd" parm_must="1" parm_desc="descriptionddf"/>
                    <ParamsTrNew />
                </tbody>
            </table>
        );
    }
});

//渲染到页面上
ReactDOM.render(
    <ParamsTable />,
    document.getElementById('params-box')
);
