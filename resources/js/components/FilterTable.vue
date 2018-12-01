<template>
    <div class="aside">
        <div class="title">
            Filters
        </div>
        <hr>
        <el-row :gutter="20">
            <el-col :span="12" class="text-center">
                <label>Price Min</label>
                <el-input suffix-icon="el-icon-minus" />
            </el-col>
            <el-col :span="12" class="text-center">
                <label>Price Max</label>
                <el-input suffix-icon="el-icon-plus" />
            </el-col>
        </el-row>
        <br>
        <el-row :gutter="20">
            <el-col :span="12" class="text-center">
                <label>Pages Min</label>
                <el-input suffix-icon="el-icon-minus" />
            </el-col>
            <el-col :span="12" class="text-center">
                <label>Pages Max</label>
                <el-input suffix-icon="el-icon-plus" />
            </el-col>
        </el-row>
        <br>
        <el-row>
            <el-col class="text-center">
                <label>Select Category</label>
                <el-select placeholder="Category..." class="cat-select">
                    <el-option>HOla</el-option>
                </el-select>
            </el-col>
        </el-row>
        <br>
        <el-row>
            <el-col class="text-center">
                <label>Author</label>
                <el-input placeholder="Author" />
            </el-col>
        </el-row>
        <br>
        <el-row>
            <el-col class="text-center">
                <label>Language</label>
                <el-select class="cat-select" placeholder="Language">
                    <el-option>
                        English
                    </el-option>
                </el-select>
            </el-col>
        </el-row>
        <br>
        <el-row>
            <el-col>
                <el-checkbox>Available</el-checkbox>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        name: "FilterTable"
    }
</script>

<style scoped>
    .aside {
        border: 1px solid #C0C4CC;
        height: 600px;
        background-color: white;
        border-radius: 4px;
        padding: 20px;
    }

    .title {
        font-size: large;
        text-align: center;

    }

    .text-center {
        font-size: small;
        text-align: center;
    }

    .cat-select {
        width: 100%;
    }

    hr {
        background-color: #011e4f;
        color: #011e4f;
        border: none;
        height: 1px;
        margin-bottom: 20px;
        margin-top: 20px;
    }
</style>