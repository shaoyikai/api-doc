
var ParamsTable = React.createClass({
    getInitialState:function(){
        return {
            value1:'', //名称
            value2:0, //类型
            value3:1, //是否可选
            value4:'', //说明
            indexTr:0,
            data:[]
        };
    },
    handleChange1:function(event){
        this.setState({
            value1:event.target.value
        });
    },
    handleChange2:function(event){
        this.setState({
            value4:event.target.value
        });
    },

    handleSelect1:function(event){
        this.setState({
            value2:event.target.value
        });
    },
    handleSelect2:function(event){
        this.setState({
            value3:event.target.value
        });
    },

    // 验证数据是否合法
    checkData:function () {
        if(this.state.value1.length<1){
            alert('请输入名称');
            return false;
        }else{
            return true;
        }
    },
    //新增一行
    addNewTr:function(){
        if(this.checkData()){
            var newObj = {
                parm_name: this.state.value1,
                parm_type: this.state.value2,
                parm_must: this.state.value3,
                parm_desc: this.state.value4
            };
            var newData = this.state.data;
            newData.push(newObj);
            this.setState({
                data:newData
            });
        }
    },
    //删除本行
    removeTr:function(event){
        console.log(event.target.value);
    },
    render: function() {
        var ParamsTrs = this.state.data.map((comment,i) => {
            return (
                <tr id={"tr-"+i}>
                    <td>{comment.parm_name}</td>
                    <td>{comment.parm_type == 1 ? 'int' : 'string'}</td>
                    <td>{comment.parm_must == 0 ? '是' : '否'}</td>
                    <td>{comment.parm_desc}</td>
                    <td>
                        <a href="javascript:void(0)" value={i} className="btn btn-warning" onClick={this.removeTr.bind(this)}>-</a>
                    </td>
                </tr>
            );
        });

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
                    {ParamsTrs }
                    <tr>
                        <td>
                            <input type="text" id="par_id" placeholder="请输入名称" value={this.state.value1} onChange={this.handleChange1}/>
                        </td>
                        <td>
                            <select id="par_type" onChange={this.handleSelect1} value={this.state.value2}>
                                <option value="0" selected>string</option>
                                <option value="1">int</option>
                            </select>
                        </td>
                        <td>
                            <select id="par_must" onChange={this.handleSelect2} value={this.state.value3}>
                                <option value="0" selected>是</option>
                                <option value="1">否</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" id="par_desc" placeholder="请输入描述" value={this.state.value4} onChange={this.handleChange2}/>
                        </td>
                        <td>
                            <a href="javascript:void(0)" className="btn btn-success" onClick={this.addNewTr.bind(this)}>+</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        );
    }
});

ReactDOM.render(
    <ParamsTable />,
    document.getElementById('params-box')
);
