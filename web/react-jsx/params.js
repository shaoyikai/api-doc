/**
 * Created by yikai on 2016-6-12.
 * react jsx file
 */


/*
<tr>
    <td><input type="text" id="par_name"></td>
    <td>
        <select id="par_type">
            <option value="0" selected>string</option>
            <option value="1">int</option>
        </select>
    </td>
    <td>
        <select id="par_must">
            <option value="0" selected>否</option>
            <option value="1">是</option>
        </select>
    </td>
    <td><input type="text" id="par_desc"></td>

    <td>
        <?php if($model->isNewRecord):?>
        <a href="javascript:void(0)" onclick="addParams()" class="btn btn-success">+</a>
        <?php else:?>
        <a href="javascript:void(0)" onclick="addParamsOne()" class="btn btn-success">+</a>
        <?php endif;?>
    </td>

</tr>
*/
var Input = React.createClass({
    render: function() {

        return (
            <input type={this.props.type} id={this.props.id} placeholder={this.props.desc}/>
        );
    }
});
var Select1 = React.createClass({
    render: function() {
        return (
            <select id="par_type">
                <option value="0" selected>string</option>
                <option value="1">int</option>
            </select>
        );
    }
});

var Select2 = React.createClass({
    render: function() {
        return (
            <select id="par_must">
                <option value="0" selected>否</option>
                <option value="1">是</option>
            </select>
        );
    }
});
var Link = React.createClass({
    render: function() {
        return (
            <a href="javascript:void(0)" onclick="addParamsOne()" className="btn btn-success">+</a>
        );
    }
});

//-------------------------------------------

var ParamsTr = React.createClass({
    render: function() {
        return (
            <tr>
                <td>{this.props.parm_name}</td>
                <td>{this.props.parm_type}</td>
                <td>{this.props.parm_must}</td>
                <td>{this.props.parm_desc}</td>
                <td>
                    <a href="javascript:void(0)" onClick={this.removeParams} className="btn btn-warning">-</a>
                </td>
            </tr>
        );
    }
});

var ParamsTrNew = React.createClass({
    render: function() {
        return (
            <tr>
                <td><Input type="text" id="par_id" desc="请输入名称"/></td>
                <td><Select1 /></td>
                <td><Select2 /></td>
                <td><Input type="text" id="" desc="请输入描述"/></td>
                <td><Link /></td>
            </tr>
        );
    }
});
var ParamsTable = React.createClass({
    render: function() {
        return React.createElement('table',{className:"table table-bordered"},
            <tbody>
                <tr>
                    <th>参数</th>
                    <th>类型</th>
                    <th>是否可选</th>
                    <th>说明</th>
                    <th>操作</th>
                </tr>
                <ParamsTr parm_name="nameee" parm_type="ddfd" parm_must="1" parm_desc="description ss"/>
                <ParamsTrNew />
            </tbody>
        );
    }
});

var box = document.getElementById('params-box');
ReactDOM.render(<ParamsTable />,box);


