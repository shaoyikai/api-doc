
// 获取cookie
function getCookie(cookie_name) {
    var all_cookies = document.cookie;
    var cookie_pos = all_cookies.indexOf(cookie_name);

    if (cookie_pos != -1) {
        cookie_pos += cookie_name.length + 1;
        var cookie_end = all_cookies.indexOf(";", cookie_pos);

        if (cookie_end == -1) {
            cookie_end = all_cookies.length;
        }
        return unescape(all_cookies.substring(cookie_pos, cookie_end));
    }
}
var params = eval(getCookie('params')); // 将得到的 string 转换为 object

var ParamsTable = React.createClass({
    getInitialState: function () {
        return {
            value1: '', // 名称
            value2: 0, // 类型
            value3: 1, // 是否可选
            value4: '', // 说明
            data: params || [] // 从cookie中读取现有的参数
        };
    },
    handleChange1: function (event) {
        this.setState({
            value1: event.target.value
        });
    },
    handleChange2: function (event) {
        this.setState({
            value4: event.target.value
        });
    },

    handleSelect1: function (event) {
        this.setState({
            value2: event.target.value
        });
    },
    handleSelect2: function (event) {
        this.setState({
            value3: event.target.value
        });
    },

    // 验证数据是否合法
    checkData: function () {
        if (this.state.value1.length < 1) {
            alert('请输入名称');
            return false;
        } else {
            return true;
        }
    },
    // 新增一行
    addNewTr: function () {
        if (this.checkData()) {
            var newObj = {
                parm_name: this.state.value1,
                parm_type: this.state.value2,
                parm_must: this.state.value3,
                parm_desc: this.state.value4
            };
            var newData = this.state.data;
            newData.push(newObj);

            this.setState({
                value1: '', // 名称
                value2: 0, // 类型
                value3: 1, // 是否可选
                value4: '', // 说明
                data: newData
            });
        }
    },
    // 删除本行
    removeTr: function (event) {
        let id = event.target.value;
        let trDom = $('#tr-' + id);
        trDom.remove();
    },
    render: function () {
        var ParamsTrs = this.state.data.map((comment, i) => {
            return (
                <tr id={"tr-"+i}>
                    <td>{comment.parm_name}</td>
                    <td>{comment.parm_type == 1 ? 'int' : 'string'}</td>
                    <td>{comment.parm_must == 0 ? '是' : '否'}</td>
                    <td>{comment.parm_desc}</td>
                    <td>
                        <input type="hidden" name={"Api[params]["+i+"][parm_name]"} value={comment.parm_name}/>
                        <input type="hidden" name={"Api[params]["+i+"][parm_type]"} value={comment.parm_type}/>
                        <input type="hidden" name={"Api[params]["+i+"][parm_must]"} value={comment.parm_must}/>
                        <input type="hidden" name={"Api[params]["+i+"][parm_desc]"} value={comment.parm_desc}/>
                        <a href="javascript:void(0)" value={i} className="btn btn-warning"
                           onClick={this.removeTr.bind(this)}>-</a>
                    </td>
                </tr>
            );
        });

        return (
            <div className="form-group">
                <div className="col-xs-3 col-sm-2 text-right">
                    <label className="control-label">参数</label>
                </div>
                <div className="col-xs-9 col-sm-9">
                    <table className="table table-bordered">
                            <tbody>
                            <tr>
                                <th>参数</th>
                                <th>类型</th>
                                <th>是否可选</th>
                                <th>说明</th>
                                <th>操作</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" onChange={this.handleChange1} value={this.state.value1} placeholder="请输入名称"/>
                                </td>
                                <td>
                                    <select onChange={this.handleSelect1} value={this.state.value2}>
                                        <option value="0" selected>string</option>
                                        <option value="1">int</option>
                                    </select>
                                </td>
                                <td>
                                    <select onChange={this.handleSelect2} value={this.state.value3}>
                                        <option value="0" selected>是</option>
                                        <option value="1">否</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" onChange={this.handleChange2} value={this.state.value4} placeholder="请输入描述"/>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" className="btn btn-success"
                                       onClick={this.addNewTr.bind(this)}>+</a>
                                </td>
                            </tr>
                            {ParamsTrs}
                            </tbody>
                        </table>
                    </div>
            </div>
        );
    }
});

ReactDOM.render(
    <ParamsTable />,
    document.getElementById('params-box')
);
