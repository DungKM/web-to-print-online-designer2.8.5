<div class="nbd-tab-ai tab <?php if( $active_aidesign ) echo 'active'; ?>" id="tab-ai">
<style>
.nbd-tab-ai {
    display: flex;
    flex-direction: column;
    width: 100%;
    max-width: 600px;
    margin: 20px auto;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
    overflow: hidden;
    font-family: 'Arial', sans-serif;
}

.nbd-tab-main {
    padding: 20px;
    overflow-y: auto;
    max-height: 500px;
}

.nbd-tab-scroll {
    scrollbar-width: thin;
    scrollbar-color: #ccc #f9f9f9;
}

.nbd-tab-scroll::-webkit-scrollbar {
    width: 8px;
}

.nbd-tab-scroll::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 4px;
}

.nbd-prompt-ai {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    outline: none;
    font-size: 14px;
    background-color: #f9f9f9;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    transition: border-color 0.2s ease-in-out;
}

.nbd-prompt-ai:focus {
    border-color: #007bff;
    background-color: #fff;
}

.nbd-btn-generate-image {
    width: 100%;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: bold;
    color: #ffffff;
    background-color: #007bff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
}

.nbd-btn-generate-image:hover {
    background-color: #0056b3;
}

.nbd-loading-message {
    margin-top: 15px;
    font-size: 14px;
    color: #777;
    text-align: center;
}
.nbd-image-ai {
    display: block;
    max-width: 100%;
    margin: 20px auto 0;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.tab-ai.active {
    box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
}
.no-images {
    margin-top: 20px;
    font-size: 16px;
    font-weight: bold;
    color: #ff0000;
    text-align: center;
}
</style>
    <div class="nbd-tab-main nbd-tab-scroll">
       <div ng-app="nbd-app" ng-controller="MyController">
            <input class="nbd-prompt-ai" type="text" ng-model="prompt" placeholder="Enter text">
            <button class="nbd-btn-generate-image" ng-click="generateImage()">Generate Image</button>
            <div class="nbd-loading-message" ng-bind="loadingMessage"></div>
            <div ng-if="!imageUrls || imageUrls.length === 0" class="no-images">
                    You don’t have any images yet.
            </div>
            <img ng-if="imageUrls && imageUrls.length > 0" ng-src="{{imageUrls[0]}}" alt="Hình ảnh đầu tiên" class="nbd-image-ai">
       </div>
    </div>
</div>