<div class="nbd-tab-ai tab <?php if ($active_aidesign) echo 'active'; ?>" id="tab-ai">
    <style>
        #tab-ai .tab-main {
            height: calc(100% - 70px);
        }

        .nbd-tab-ai {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            border-radius: 10px;
            overflow: hidden;
            font-family: 'Arial', sans-serif;
        }

        .nbd-tab-main {
            padding: 20px;
            overflow-y: auto;
            max-height: 600px;
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
            box-shadow: 1px 0 21px rgba(0, 0, 0, .15);
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
            color: #ffffff;
            background-color: #404762;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .nbd-btn-generate-image:hover {
            box-shadow: 0 3px 5px -1px rgba(0, 0, 0, .2), 0 5px 8px 0 rgba(0, 0, 0, .14), 0 1px 14px 0 rgba(0, 0, 0, .12);
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
        }

        textarea.nbd-prompt-ai {
            resize: none !important;
            width: 300px;
            height: 150px;
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

        .nbd-search-ai {
            padding: 20px;
        }
    </style>
    <div ng-app="nbd-app" ng-controller="MyController">
        <div class="nbd-search-ai">
            <textarea placeholder="Enter your AI image description here, e.g., 'A futuristic cityscape at sunset with flying cars'." class="nbd-prompt-ai" ng-model="prompt"></textarea>
            <button class="nbd-btn-generate-image" ng-disabled="isLoading" ng-click="generateImage()">
                <span ng-if="!isLoading" style="color:#f9f9f9">Generate Image</span>
                <span ng-if="isLoading" style="color:#f9f9f9">Loading...</span></button>
        </div>
        <div class="nbd-tab-main tab-main nbd-tab-scroll">
            <img ng-if="imageUrls && imageUrls.length > 0" ng-src="{{imageUrls[0]}}" alt="Hình ảnh đầu tiên" class="nbd-image-ai">
        </div>
    </div>
</div>