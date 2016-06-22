

var ParamsTr = React.createClass({

    removeParams:function(event){
        alert('remove self');
    },
    render: function() {
        var data = this.props.data;

        return (
            <tr>
                <td>{data.parm_name}</td>
                <td>{data.parm_type}</td>
                <td>{data.parm_must}</td>
                <td>{data.parm_desc}</td>
                <td>
                    <a href="javascript:void(0)" onClick={this.removeParams} className="btn btn-warning">-</a>
                </td>
            </tr>
        );
    }
});

var ParamsTrNew = React.createClass({
    getInitialState:function(){
        return {
            value1:'hello!',
            value2:'hello!'
        };
    },
    handleChange:function(event){
        this.setState({
            value1:event.target.value,
            value2:event.target.value
        });
    },

    addParams:function(){
        alert('heheheheh');
    },

    render: function() {
        return (
            <tr>
                <td>
                    <input
                        type="text"
                        id="par_id"
                        placeholder="请输入名称"
                        value={this.state.value1}
                        onChange={this.handleChange}
                    />
                </td>

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

                <td>
                    <input
                        type="text"
                        id="par_desc"
                        placeholder="请输入描述"
                        value={this.state.value2}
                        onChange={this.handleChange}
                    />
                </td>

                <td>
                    <a href="javascript:void(0)" onClick={this.addParams} className="btn btn-success">+</a>
                </td>
            </tr>
        );
    }
});
var ParamsTable = React.createClass({
    render: function() {
        var data = {
            parm_name:"nameee",
            parm_type:"string",
            parm_must:"1",
            parm_desc:"desssc"
        };
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
                    <ParamsTr data={data}/>
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
