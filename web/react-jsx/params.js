
var ParamsTr = React.createClass({

    removeSelf:function(){
        ReactDOM.unmountComponentAtNode(ReactDOM.findDOMNode(this));
        $(ReactDOM.findDOMNode(this)).remove();
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
                    <a href="javascript:void(0)" onClick={this.removeSelf} className="btn btn-warning">-</a>
                </td>
            </tr>
        );
    }
});

var ParamsTrNew = React.createClass({
    getInitialState:function(){
        return {
            value1:'',
            value2:''
        };
    },
    handleChange1:function(event){
        this.setState({
            value1:event.target.value
        });
    },
    handleChange2:function(event){
        this.setState({
            value2:event.target.value
        });
    },

    addNew:function(){
        console.log();
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
                        onChange={this.handleChange1}
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
                        onChange={this.handleChange2}
                    />
                </td>

                <td>
                    <a href="javascript:void(0)" onClick={this.addNew} className="btn btn-success">+</a>
                </td>
            </tr>
        );
    }
});
var ParamsTable = React.createClass({
    getInitialState:function(){
        return {};
    },

    render: function() {
        var data = {
            parm_name: "nameee",
            parm_type: "string",
            parm_must: "1",
            parm_desc: "desssc"
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

ReactDOM.render(
    <ParamsTable />,
    document.getElementById('params-box')
);
